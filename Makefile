protoc-uam:
	protoc \
		--proto_path=src/Grpc/Uam/schema \
		--php_out=src/ \
		--grpc_out=src/ \
		--plugin=protoc-gen-grpc=grpc_php_plugin \
		uam_rpc.proto \
	&& cp -r src/Inexdigital/UamAuthorization/Grpc src/ \
	&& rm -rf src/Inexdigital